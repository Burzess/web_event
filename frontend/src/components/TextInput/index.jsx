import React from 'react';
import { Form } from 'react-bootstrap';

export default function TextInput({ name, value, type, onChange, placeholder, onFocus }) {
    return (
        <Form.Control
            name={name}
            value={value}
            type={type}
            placeholder={placeholder}
            onChange={onChange}
            onFocus={onFocus}
        />
    );
}
