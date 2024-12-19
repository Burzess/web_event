import React from 'react';
import { Nav } from 'react-bootstrap';

export default function NavLink({ action, children, className }) {
    return (
        <Nav.Link onClick={action} className={className}>
            {children}
        </Nav.Link>
    );
}
