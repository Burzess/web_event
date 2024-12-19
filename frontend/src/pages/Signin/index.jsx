import { useState } from 'react';
import { Card } from 'react-bootstrap';
import axios from 'axios';
import { config } from '../../configs/index';
import { Navigate, useNavigate } from 'react-router-dom';
import SForm from './form';
import './login.css';
import { useDispatch } from 'react-redux';
import { userLogin } from '../../redux/auth/actions';

function PageSignin() {
    const dispatch = useDispatch();
    const navigate = useNavigate();

    const [form, setForm] = useState({
        email: '',
        password: '',
    });

    const [error, setError] = useState({
        status: false,
        message: '',
        typeInput: '',
    });

    const [isLoading, setIsLoading] = useState(false);

    const handleChange = (e) => {
        setForm({ ...form, [e.target.name]: e.target.value });
    };

    const clearError = (inputName) => {
        if (error.typeInput === inputName) {
            setError({
                status: false,
                message: '',
                typeInput: '',
            });
        }
    };
    ;

    const handleSubmit = async () => {
        setIsLoading(true);
        try {
            const res = await axios.post(`${config.api_host_dev}/login`, form);

            dispatch(
                userLogin(
                    res.data.token,
                    res.data.user.role.name,
                )
            );

            setIsLoading(false);
            navigate('/')
        } catch (err) {
            setIsLoading(false);
            console.log(err);


            const status = err.response?.status;
            const message = err.response?.data?.msg || err.response?.data?.message;

            if (status === 401) {
                setError({
                    status: true,
                    message: message,
                    typeInput: 'password',
                });
                setForm((prevForm) => ({ ...prevForm, password: '' }));
            } else if (status === 404 || status === 422) {
                setError({
                    status: true,
                    message: message,
                    typeInput: 'email',
                });
                setForm((prevForm) => ({ ...prevForm, email: '' }));
            } else {
                setError({
                    status: true,
                    message: 'Unexpected error occurred',
                    typeInput: '',
                });
            }
        }
    };

    return (
        <div className="bg-image">
            <div className="centered-container">
                <Card className="login-card">
                    <Card.Title className="text-center">Login</Card.Title>
                    <Card.Body>
                        <SForm
                            form={form}
                            handleChange={handleChange}
                            isLoading={isLoading}
                            handleSubmit={handleSubmit}
                            error={error}
                            clearError={clearError}
                        />
                    </Card.Body>
                </Card>
            </div>
        </div>
    );
}

export default PageSignin;
