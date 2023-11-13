import React from 'react';
import { ThemeProvider, createTheme } from '@mui/material/styles';
import {createRoot} from 'react-dom/client';
import {BrowserRouter as Router, Route, Routes} from 'react-router-dom';
import Layout from './components/Layout';
import HomePage from './components/HomePage';
import UniversePage from './components/UniversePage';
import ErrorBoundary from "./ErrorBoundary";
import MovieDetailPage from "./components/MoviePage";

const container = document.getElementById('app');
const root = createRoot(container);

const theme = createTheme({
    palette: {
        primary: {
            main: '#556cd6',
        },
        secondary: {
            main: '#19857b',
        },
        error: {
            main: '#ff0000',
        },
    },
});

root.render(
    <React.StrictMode>
        <ThemeProvider theme={theme}>
            <Router>
                <Layout>
                    <ErrorBoundary>
                        <Routes>
                            <Route path="/" element={<HomePage />} />
                            <Route path="/universe/:id" element={<UniversePage />} />
                            <Route path="/movie/:movieId" element={<MovieDetailPage />} />
                        </Routes>
                    </ErrorBoundary>
                </Layout>
            </Router>
        </ThemeProvider>
    </React.StrictMode>
);
