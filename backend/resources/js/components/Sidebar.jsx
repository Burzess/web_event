import React, { useEffect, useState } from "react";
import { Nav } from "react-bootstrap";
import { useNavigate, useLocation } from "react-router-dom";
import NavLink from './NavLink';
import { postData } from "../../utils/fetch";
import { accessCategories, accessEvents, accessOrders, accessPayments, accessTalents } from "../../const/access";

const Sidebar = () => {
    const navigate = useNavigate();
    const location = useLocation();
    const [role, setRole] = useState(null);

    useEffect(() => {
        const fetchData = () => {
            let { role } = localStorage.getItem('auth')
                ? JSON.parse(localStorage.getItem('auth'))
                : {};

            setRole(role);
        };
        fetchData();
    }, []);

    const handleLogout = async () => {
        try {
            await postData('/logout');

            localStorage.clear();
            window.location.href = '/signin';
        } catch (error) {
            console.error('Logout gagal:', error);
            alert('Terjadi kesalahan saat logout. Silakan coba lagi.');
        }
    };


    return (
        <div className="bg-dark text-white vh-100" style={{ width: '200px', position: 'fixed' }}>
            <h3 className="text-center py-3">{role} Panel</h3>
            <Nav className="flex-column px-3">
                <NavLink
                    action={() => navigate('/')}
                    className={location.pathname === '/dasboard' || location.pathname === '/' ? 'active-link' : ''}
                >
                    Dashboard
                </NavLink>
                <NavLink
                    role={role}
                    roles={accessCategories.lihat}
                    action={() => navigate('/categories')}
                    className={location.pathname.startsWith('/categories') ? 'active-link' : ''}
                >
                    Categories
                </NavLink>
                <NavLink
                    role={role}
                    roles={accessTalents.lihat}
                    action={() => navigate('/talents')}
                    className={location.pathname.startsWith('/talents') ? 'active-link' : ''}
                >
                    Talents
                </NavLink>
                <NavLink
                    role={role}
                    roles={accessEvents.lihat}
                    action={() => navigate('/events')}
                    className={location.pathname.startsWith('/events') ? 'active-link' : ''}
                >
                    Events
                </NavLink>
                <NavLink
                    role={role}
                    roles={accessPayments.lihat}
                    action={() => navigate('/payments')}
                    className={location.pathname.startsWith('/payments') ? 'active-link' : ''}
                >
                    Payments
                </NavLink>
                <NavLink
                    role={role}
                    roles={accessOrders.lihat}
                    action={() => navigate('/orders')}
                    className={location.pathname.startsWith('/orders') ? 'active-link' : ''}
                >
                    Orders
                </NavLink>
                <button className="btn btn-danger mt-3" onClick={handleLogout}>
                    Logout
                </button>
            </Nav>
        </div>
    );
};

export default Sidebar;
