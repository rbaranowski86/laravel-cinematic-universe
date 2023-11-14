import puppeteer, {Browser, Page} from 'puppeteer';
import assert from 'assert';

const showBrowser = true;

let browser: Browser | null = null;

beforeAll(async () => {
    browser = await puppeteer.launch({
        headless: !showBrowser,
        defaultViewport: null,
        args: ['--window-size=1920,1040'],
        // slowMo: 50
    });
});

afterAll(async () => {
    if (browser) {
        await browser.close();
    }
});

it('should add, edit, and delete a universe', async () => {
    const page = await browser!.newPage();
    await page.goto('http://localhost');

    const title = await page.title();
    expect(title).toBeTruthy();

    //add test
    await page.waitForSelector('button#add-universe');
    await page.click('button#add-universe');
    await page.waitForSelector('input#name');
    await page.type('input#name', 'Test Universe');
    await page.type('input#description', 'A test universe description');
    await page.type('input#foundation-year', '2023');
    await page.click('button#submit-button');

    await page.waitForSelector('.MuiCardContent-root::-p-text(Test Universe)');
    const value = await page?.$eval('h2::-p-text(Test Universe)', el => el.innerHTML);
    assert.strictEqual(value, 'Test Universe');


    //edit test
    const editButtons = await page.$$('button::-p-text(Edit)');
    editButtons[1].click();
    await page.waitForSelector('input#name');
    await page.type('input#name', ' Updated');
    await page.click('button#submit-button');


    await page.waitForSelector('.MuiCardContent-root::-p-text(Test Universe Updated)');
    const valueUpdated = await page?.$eval('h2::-p-text(Test Universe Updated)', el => el.innerHTML);
    assert.strictEqual(valueUpdated, 'Test Universe Updated');

    //delete test
    const deleteButtons = await page.$$('button::-p-text(Delete)');
    await deleteButtons[1].click();

    //give react time to remove the card
    await new Promise(r => setTimeout(r, 100));

    const cardsSelector = await page.$$('.MuiCardContent-root');
    assert.strictEqual(1, cardsSelector.length);

}, 20000);
