import React from 'react';
import {createRoot} from 'react-dom/client';
import {BrowserRouter as Router, Route, Routes} from 'react-router-dom';
import HomePage from './components/HomePage';
import UniversePage from './components/UniversePage';
import ErrorBoundary from "./ErrorBoundary";

const container = document.getElementById('app');
const root = createRoot(container);

root.render(
    <React.StrictMode>
        <Router>
            <ErrorBoundary>
                <Routes>
                    <Route path="/" element={<HomePage/>}/>
                    <Route path="/universe/:id" element={<UniversePage/>}/>
                </Routes>
            </ErrorBoundary>
        </Router>
    </React.StrictMode>
);
