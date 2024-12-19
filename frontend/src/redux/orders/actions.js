import {
  START_FETCHING_ORDERS,
  SUCCESS_FETCHING_ORDERS,
  ERROR_FETCHING_ORDERS,
  SET_DATE,
  SET_PAGE,
} from './constants';

import { getData } from '../../utils/fetch';
import debounce from 'debounce-promise';

import moment from 'moment';
import { formatDate } from '../../utils/formatDate';

let debouncedFetchOrders = debounce(getData, 1000);

export const startFetchingOrders = () => {
  return {
    type: START_FETCHING_ORDERS,
  };
};

export const successFetchingOrders = ({ orders, pages }) => {
  return {
    type: SUCCESS_FETCHING_ORDERS,
    orders,
    pages,
  };
};

export const errorFetchingOrders = () => {
  return {
    type: ERROR_FETCHING_ORDERS,
  };
};

export const fetchOrders = () => {
  return async (dispatch, getState) => {
    dispatch(startFetchingOrders());

    try {
      let params = {
        page: getState().orders.page || 1,
        limit: getState().orders.limit || 10,
        startDate: getState().orders.date?.startDate || moment().format('YYYY-MM-DD'),
        endDate: getState().orders.date?.endDate || moment().format('YYYY-MM-DD'),
      };

      let res = await debouncedFetchOrders('/orders', params);

      dispatch(
        successFetchingOrders({
          orders: res.data.order,
          pages: res.data.pages,
        })
      );
    } catch (error) {
      dispatch(errorFetchingOrders());
    }
  };
};

export const setPage = (page) => {
  return {
    type: SET_PAGE,
    page,
  };
};

export const setDate = (ranges) => {
  return {
    type: SET_DATE,
    ranges,
  };
};
