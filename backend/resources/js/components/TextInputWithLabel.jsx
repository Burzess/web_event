import React from 'react';
import { Form } from 'react-bootstrap';
import TextInput from './TextInput';

export default function TextInputWithLabel({
    label,
    name,
    value,
    type,
    onChange,
    placeholder,
    onFocus,
    error = {}
}) {
    return (
        <Form.Group className='mb-3'>
            <Form.Label className='text-start d-block'>{label}</Form.Label>
            <TextInput
                name={name}
                value={value}
                type={type}
                onChange={onChange}
                onFocus={onFocus}
                placeholder={placeholder}
            />
            {error.status && <Form.Text className="text-danger text-start d-block">{error.message}</Form.Text>}
        </Form.Group>
    );
}
