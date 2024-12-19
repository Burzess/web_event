import { Route, Routes } from 'react-router-dom';
import PageCategories from '../pages/categories';
import CategoriesCreatePage from '../pages/categories/create';
import CategoriesEditPage from '../pages/categories/edit';

export function CategoriesRoute() {
  return (
    <Routes>
      <Route path='/' element={<PageCategories />} />
      <Route path='/create' element={<CategoriesCreatePage />} />
      <Route path='/edit/:id' element={<CategoriesEditPage />} />
    </Routes>
  );
}
