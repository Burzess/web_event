import React from 'react'
import Container from 'react-bootstrap/Container';
import { Navbar, Nav } from 'react-bootstrap';
import { useNavigate } from 'react-router-dom';
import NavLink from '../Navlink';


function SNavbar() {
    const navigate = useNavigate();

    return (
        <Navbar bg="light" expand="lg" className="shadow-sm">
            <Container>
                <Navbar.Brand href="#home">Dashboard Admin</Navbar.Brand>
                <Navbar.Toggle aria-controls="basic-navbar-nav" />
                <Navbar.Collapse id="basic-navbar-nav">
                    <Nav className="me-auto">
                        <NavLink action={() => navigate('/')}>Dashboard</NavLink>
                        <NavLink action={() => navigate('/categories')} >Categories</NavLink>
                        <NavLink action={() => navigate('/talent')} >Talents</NavLink>
                        <NavLink action={() => navigate('/event')} >Events</NavLink>
                        <NavLink action={() => navigate('/participant')} >Participant</NavLink>
                        <NavLink action={() => navigate('/transaction')} >Transactions</NavLink>
                    </Nav>
                    <Nav>
                        <button className="btn btn-danger">
                            Logout
                        </button>
                    </Nav>
                </Navbar.Collapse>
            </Container>
        </Navbar>
    );
}

export default SNavbar;
