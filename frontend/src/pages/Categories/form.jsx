import React from 'react'
import { Form } from 'react-bootstrap';
import TextInputWithLabel from '../../components/TextInputWithLabel';
import SButton from '../../components/Button';

export default function CategoriesForm({ handleSubmit, form, handleChange, isLoading, edit }) {
    return (
        <Form>
            <TextInputWithLabel
                placeholder={'Masukan Nama Kategori'}
                label={'Nama Kategori'}
                name='name'
                value={form.name}
                type='text'
                onChange={handleChange}
            />
            <SButton variant='primary' action={handleSubmit} loading={isLoading}>
                {edit ? 'Ubah' : 'Simpan'}
            </SButton>
        </Form>
    )
}
