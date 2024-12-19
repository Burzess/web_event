import { Route, Routes } from 'react-router-dom';

import Events from '../pages/Events';
import Create from '../pages/Events/create';
import Edit from '../pages/Events/edit';
import EventForm from '../components/EventForm/Index';

export function EventsRoute() {
  return (
    <Routes>
      <Route path='/' element={<Events />} />
      <Route path='/create' element={<Create />} />
      <Route path='/createUsingMap' element={<EventForm />} />
      <Route path='/edit/:id' element={<Edit />} />
    </Routes>
  );
}
