import React from 'react'
import { Form } from 'react-bootstrap'
import TextInputWithLabel from '../../components/TextInputWithLabel'
import SButton from '../../components/Button'
import GoogleLoginButton from '../../components/GoogleLoginButton';

export default function SForm({ form, handleChange, isLoading, handleSubmit, error, clearError }) {
    return (
        <Form>
            <TextInputWithLabel
                label="Email address"
                name="email"
                value={form.email}
                type="email"
                placeholder="Enter email"
                onChange={handleChange}
                onFocus={() => clearError('email')}
                error={error.typeInput === 'email' ? error : {}}
            />
            <TextInputWithLabel
                label="Password"
                name="password"
                value={form.password}
                type="password"
                placeholder="Enter Password"
                onChange={handleChange}
                onFocus={() => clearError('password')}
                error={error.typeInput === 'password' ? error : {}}
            />

            <SButton loading={isLoading} disabled={isLoading} action={handleSubmit} variant="primary" type="submit">
                Submit
            </SButton>
            <GoogleLoginButton />
        </Form>
    );
}
