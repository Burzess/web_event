import { Navigate, Route, Routes } from 'react-router-dom';
import GuardRoute from '../components/GuardRoute';
import GuestOnlyRoute from '../components/GuestOnlyRoute';
import Login from '../pages/Signin';
import { HomeRoute } from './HomeRoute';
import { TalentsRoute } from './TalentsRoute';
import { CategoriesRoute } from './CategoriesRoute';
import { EventsRoute } from './EventsRoute';
import { PaymentsRoute } from './PaymentsRoute';
import { OrdersRoute } from './OrdersRoute';
import Sidebar from '../components/Sidebar';

export default function AppRoutes() {
  return (
    <Routes>
      <Route
        path='signin'
        element={
          <GuestOnlyRoute>
            <Login />
          </GuestOnlyRoute>
        }
      />
      <Route
        path='/'
        element={
          <>
            <Sidebar />
            <GuardRoute />
          </>
        }
      >
        <Route path='dashboard/*' element={<HomeRoute />} />
        <Route path='categories/*' element={<CategoriesRoute />} />
        <Route path='talents/*' element={<TalentsRoute />} />
        <Route path='events/*' element={<EventsRoute />} />
        <Route path='payments/*' element={<PaymentsRoute />} />
        <Route path='orders/*' element={<OrdersRoute />} />
        <Route path='' element={<Navigate to='/dashboard' replace={true} />} />
      </Route>
    </Routes>
  );
}
