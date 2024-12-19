import React from 'react'
import { Navigate } from 'react-router';
import { Container } from 'react-bootstrap';
import SBreadcrumd from '../../components/Breadcrumb';

export default function Dashboard() {
  return (
    <>
      <Container className='mt'>
        <SBreadcrumd />
      </Container>

    </>
  )
}
