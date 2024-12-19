import Container from 'react-bootstrap/Container';
import { Navbar, Nav } from 'react-bootstrap';
import { useNavigate } from 'react-router-dom';
import NavLink from '../NavAccess';
import { useEffect, useState } from 'react';


function SNavbar() {
    const navigate = useNavigate();
    const [role, setRole] = useState(null);

    console.log('role');
    console.log(role);

    useEffect(() => {
        const fetchData = () => {
            let { role } = localStorage.getItem('auth')
                ? JSON.parse(localStorage.getItem('auth'))
                : {};

            setRole(role);
        };
        fetchData();
    }, []);

    const handleLogout = () => {
        localStorage.clear();
        window.location.href = '/signin';
    };
    return (
        <Navbar bg="light" expand="lg" className="shadow-sm">
            <Container>
                <Navbar.Brand href="#home">Dashboard Admin</Navbar.Brand>
                <Navbar.Toggle aria-controls="basic-navbar-nav" />
                <Navbar.Collapse id="basic-navbar-nav">
                    <Nav className="me-auto">
                        <NavLink action={() => navigate('/')}>Dashboard</NavLink>
                        <NavLink action={() => navigate('/categories')} >Categories</NavLink>
                        <NavLink action={() => navigate('/talents')} >Talents</NavLink>
                        <NavLink action={() => navigate('/events')} >Events</NavLink>
                        <NavLink action={() => navigate('/payments')} >Payments</NavLink>
                        <NavLink action={() => navigate('/orders')} >Orders</NavLink>
                    </Nav>
                    <Nav>
                        <button
                            className="btn btn-danger"
                            onClick={handleLogout}
                        >
                            Logout
                        </button>
                    </Nav>
                </Navbar.Collapse>
            </Container>
        </Navbar>
    );
}

export default SNavbar;
