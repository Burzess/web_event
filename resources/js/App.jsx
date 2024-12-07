import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import React, { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom'
import SNavbar from './components/Navbar';

createRoot(document.getElementById('root')).render(
    <StrictMode>
        <Router>
            <SNavbar />
        </Router>
    </StrictMode>,
)

