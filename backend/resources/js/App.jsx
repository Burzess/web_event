import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import { BrowserRouter as Router } from 'react-router-dom'
import { listen } from './redux/listener';
import AppRoutes from './routes';
import { useEffect } from 'react';

function App() {
    useEffect(() => {
        listen();
    }, []);
    return (
        <Router>
            <AppRoutes />
        </Router>
    )
}

export default App

