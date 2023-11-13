import React from 'react';
import { Box, Typography } from '@mui/material';

const Footer: React.FC = () => {
    return (
        <Box component="footer" sx={{ textAlign: 'center', py: 3 }}>
            <Typography variant="body1">
                &copy; {new Date().getFullYear()} Movie Universe
            </Typography>
        </Box>
    );
};

export default Footer;
