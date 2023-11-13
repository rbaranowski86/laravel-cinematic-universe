export const fetchActorInfoFromWikipedia = async (actorName) => {
    const url = `https://en.wikipedia.org/api/rest_v1/page/summary/${encodeURIComponent(actorName)}`;

    try {
        const response = await fetch(url);
        const data = await response.json();
        return {
            name: data.title,
            image: data.thumbnail?.source,
            description: data.extract
        };
    } catch (error) {
        console.error('Error fetching actor info:', error);
        return { name: '', image: '', description: '' };
    }
};
