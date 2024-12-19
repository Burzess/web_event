import React, { useEffect, useState } from 'react'
import { useNavigate } from 'react-router-dom';
import { Container, Spinner, Table } from 'react-bootstrap';
import SBreadCumd from '../../components/BreadCrumb';
import SButton from '../../components/Button';
import axios from 'axios';
import { config } from '../../configs';
import Swal from 'sweetalert2';
import { useDispatch } from 'react-redux';
import { getData } from '../../utils/fetch';

export default function PageCategories() {
    const navigate = useNavigate();
    const dispatch = useDispatch();

    const [data, setData] = useState([]);
    const [isLoading, setIsLoading] = useState(false);

    const getCategories = async () => {
        setIsLoading(true);
        try {
            const res = await getData(`/categories`);
            setData(res.data.data);
            setIsLoading(false);
        } catch (err) {
            console.log(err);
        }
    }

    useEffect(() => {
        getCategories();
    }, [])

    const handleDelete = async (id) => {
        Swal.fire({
            title: 'Apa kamu yakin?',
            text: 'Anda tidak akan dapat mengembalikan ini!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Iya, Hapus',
            cancelButtonText: 'Batal',
        }).then(async (result) => {
            if (result.isConfirmed) {
                const res = await axios.delete(`${config.api_host_dev}/categories/${id}`);
                if (res.status === 200) {
                    dispatch(getCategories());
                    dispatch(
                        setNotif(
                            true,
                            'success',
                            `berhasil hapus kategori ${res.data.data.name}`
                        )
                    );
                }
            }
        });
    };


    return (
        <>
            <Container>
                <SBreadCumd textSecound='Categories' />
                <SButton action={() => navigate('/categories/create')} className='d-block'>
                    Tambah
                </SButton>
                <Table striped bordered hover className='mt-3'>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {isLoading ? (
                            <tr>
                                <td colSpan={3} style={{ textAlign: 'center' }}>
                                    <div className="flex items-center justify-center">
                                        <Spinner animation="border" role="status" />
                                    </div>
                                </td>
                            </tr>
                        ) : (
                            data.map((data, index) => (
                                <tr key={index}>
                                    <td>{data.id}</td>
                                    <td>{data.name}</td>
                                    <td>
                                        <SButton
                                            size='sm'
                                            variant='success'
                                            action={() => navigate(`/categories/edit/${data.id}`)}
                                        >
                                            Edit
                                        </SButton>
                                        <SButton
                                            size='sm'
                                            variant='danger'
                                            className='mx-2'
                                            action={() => handleDelete(data.id)}
                                        >
                                            Hapus
                                        </SButton>
                                    </td>
                                </tr>
                            ))
                        )}
                    </tbody>
                </Table>
            </Container>

        </>
    )
}
