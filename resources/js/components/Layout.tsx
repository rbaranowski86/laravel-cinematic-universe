import React, {ReactNode} from 'react';
import Header from './Header';
import Footer from './Footer';
import Menu from './Menu';
import { Box, Container, Drawer } from '@mui/material';

const drawerWidth = 240; // Adjust based on your preference

interface LayoutProps {
    children: ReactNode;
}
const Layout: React.FC<LayoutProps> = ({ children }) => {
    return (
        <Box sx={{ display: 'flex' }}>
            <Drawer
                variant="permanent"
                sx={{
                    width: drawerWidth,
                    flexShrink: 0,
                    [`& .MuiDrawer-paper`]: { width: drawerWidth, boxSizing: 'border-box' },
                }}
            >
                <Menu />
            </Drawer>
            <Box component="main" sx={{ flexGrow: 1, p: 3 }}>
                <Header />
                <Container sx={{ mt: 8, mb: 2 }}>
                    {children}
                </Container>
                <Footer />
            </Box>
        </Box>
    );
};

export default Layout;
