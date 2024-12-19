import React from 'react'
import { Breadcrumb } from 'react-bootstrap';
import { useNavigate } from 'react-router-dom';

export default function SBreadCrumd({ textSecound, textThird, urlSecound }) {
    const navigate = useNavigate();

    return (
        <Breadcrumb className='my-2 mt-3'>
            <Breadcrumb.Item onClick={() => navigate('/')}>Home</Breadcrumb.Item>
            {!textThird && <Breadcrumb.Item active> {textSecound} </Breadcrumb.Item>}

            {textThird && (
                <Breadcrumb.Item onClick={() => navigate(urlSecound)}>{textSecound}</Breadcrumb.Item>
            )}

            {textThird && <Breadcrumb.Item active> {textThird} </Breadcrumb.Item>}
        </Breadcrumb>
    )
}
