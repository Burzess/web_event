import React, { useEffect, useRef, useState } from 'react';
import { Container } from 'react-bootstrap';
import BreadCrumb from '../../components/BreadCrumb';
import Alert from '../../components/Alert';
import Form from './form';
import { postData, getData } from '../../utils/fetch';
import { useNavigate } from 'react-router-dom';
import Swal from 'sweetalert2';
import { Marker, useMapEvents } from "react-leaflet";
import { Map as LeafletMap } from "leaflet";
import "leaflet/dist/leaflet.css";
import axios from 'axios';

function EventsCreate() {
  const navigate = useNavigate();
  const [listTalents, setListTalents] = useState([]);
  const [listCategories, setListCategories] = useState([]);

  const [form, setForm] = useState({
    title: '',
    price: '',
    date: '',
    file: '',
    avatar: '',
    about: '',
    venueName: '',
    tagline: '',
    keyPoint: [''],
    tickets: [
      {
        type: '',
        statusTicketCategories: '',
        stock: '',
        price: '',
      },
    ],
    category: '',
    talent: '',
    location: { lat: -6.2088, lon: 106.8456 },
    address: '',
  });

  const [alert, setAlert] = useState({
    status: false,
    type: '',
    message: '',
  });

  const [isLoading, setIsLoading] = useState(false);

  const getAPIListCategories = async () => {
    const res = await getData('/categories');
    const temp = [];
    res.data.data.forEach((res) => {
      temp.push({
        value: res._id,
        label: res.name,
        target: {
          value: res._id,
          name: 'category',
        },
      });
    });

    setListCategories(temp);
  };

  const getAPIListTalents = async () => {
    const res = await getData('/talents');
    const temp = [];
    res.data.data.forEach((res) => {
      temp.push({
        value: res._id,
        label: res.name,
        target: {
          value: res._id,
          name: 'talent',
        },
      });
    });

    setListTalents(temp);
  };

  const handleLocationChange = (lat, lon) => {
    fetchAddress(lat, lon);
  };

  const fetchAddress = async (lat, lon) => {
    try {
      const response = await axios.get(
        `https://api.geoapify.com/v1/geocode/reverse?lat=${lat}&lon=${lon}&apiKey=1f8c66d7a4794ea294aa88794af83a32`
      );

      const fetchedAddress = response.data.features[0]?.properties.formatted || "Unknown";

      setForm({ ...form, address: fetchedAddress, location: { lat, lon } });
    } catch (error) {
      console.error("Error fetching address:", error);
    }
  };

  const LocationMarker = () => {
    useMapEvents({
      click(e) {
        handleLocationChange(e.latlng.lat, e.latlng.lng);
      },
    });

    return <Marker position={[form.location.lat, form.location.lon]} />
  };

  useEffect(() => {
    getAPIListCategories();
    getAPIListTalents();
  }, []);

  const uploadImage = async (file) => {
    let formData = new FormData();
    formData.append('image', file);
    const res = await postData('/images', formData, true);
    return res;
  };

  const handleChange = async (e) => {
    if (e.target.name === 'avatar') {
      if (
        e?.target?.files[0]?.type === 'image/jpg' ||
        e?.target?.files[0]?.type === 'image/png' ||
        e?.target?.files[0]?.type === 'image/jpeg'
      ) {
        var size = parseFloat(e.target.files[0].size / 3145728).toFixed(2);

        if (size > 2) {
          setAlert({
            ...alert,
            status: true,
            type: 'danger',
            message: 'Please select image size less than 3 MB',
          });
          setForm({
            ...form,
            file: '',
            [e.target.name]: '',
          });
        } else {
          const res = await uploadImage(e.target.files[0]);

          console.log("res")
          console.log(res)
          setForm({
            ...form,
            file: res.data.data.id,
            [e.target.name]: res.data.data.name,
          });

          console.log("form avatar")
          console.log(form.avatar)
        }
      } else {
        setAlert({
          ...alert,
          status: true,
          type: 'danger',
          message: 'type image png | jpg | jpeg',
        });
        setForm({
          ...form,
          file: '',
          [e.target.name]: '',
        });
      }
    } else if (e.target.name === 'category' || e.target.name === 'talent') {
      setForm({ ...form, [e.target.name]: e });
    } else {
      console.log(e.target.name)
      console.log(e.target.value)
      setForm({ ...form, [e.target.name]: e.target.value });
    }
  };

  const handleSubmit = async () => {
    try {
      setIsLoading(true);

      const _temp = [];
      form.tickets.forEach((tic) => {
        _temp.push({
          type: tic.type,
          statusTicketCategories: tic.statusTicketCategories.value,
          stock: tic.stock,
          price: tic.price,
        });
      });

      const payload = {
        date: form.date,
        image: form.file,
        title: form.title,
        price: form.price,
        about: form.about,
        venueName: form.venueName,
        tagline: form.tagline,
        keyPoint: form.keyPoint,
        category: form.category.value,
        talent: form.talent.value,
        status: form.status,
        tickets: _temp,
      };

      const res = await postData('/events', payload);
      if (res.status === 201) {
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: `Berhasil simpan data ${res.data.data.title}`,
          showConfirmButton: false,
          timer: 1500,
        });
        navigate('/events');
        setIsLoading(false);
      }
    } catch (err) {
      setIsLoading(false);
    }
  };

  const handleChangeKeyPoint = (e, i) => {
    let _temp = [...form.keyPoint];

    _temp[i] = e.target.value;

    setForm({ ...form, keyPoint: _temp });
  };

  const handlePlusKeyPoint = () => {
    let _temp = [...form.keyPoint];
    _temp.push('');

    setForm({ ...form, keyPoint: _temp });
  };

  const handleMinusKeyPoint = (index) => {
    let _temp = [...form.keyPoint];
    let removeIndex = _temp
      .map(function (_, i) {
        return i;
      })
      .indexOf(index);

    _temp.splice(removeIndex, 1);
    setForm({ ...form, keyPoint: _temp });
  };

  const handlePlusTicket = () => {
    let _temp = [...form.tickets];
    _temp.push({
      type: '',
      statusTicketCategories: '',
      stock: '',
      price: '',
    });

    setForm({ ...form, tickets: _temp });
  };
  const handleMinusTicket = (index) => {
    let _temp = [...form.tickets];
    let removeIndex = _temp
      .map(function (_, i) {
        return i;
      })
      .indexOf(index);

    _temp.splice(removeIndex, 1);
    setForm({ ...form, tickets: _temp });
  };

  const handleChangeTicket = (e, i) => {
    let _temp = [...form.tickets];

    if (e.target.name === 'statusTicketCategories') {
      _temp[i][e.target.name] = e;
    } else {
      _temp[i][e.target.name] = e.target.value;
    }

    setForm({ ...form, tickets: _temp });
  };

  return (
    <Container>
      <BreadCrumb
        textSecound={'Events'}
        urlSecound={'/events'}
        textThird='Create'
      />
      {alert.status && <Alert type={alert.type} message={alert.message} />}
      <Form
        form={form}
        isLoading={isLoading}
        listCategories={listCategories}
        listTalents={listTalents}
        handleChange={handleChange}
        handleSubmit={handleSubmit}
        handleChangeKeyPoint={handleChangeKeyPoint}
        handlePlusKeyPoint={handlePlusKeyPoint}
        handleMinusKeyPoint={handleMinusKeyPoint}
        handlePlusTicket={handlePlusTicket}
        handleMinusTicket={handleMinusTicket}
        handleChangeTicket={handleChangeTicket}
        LocationMarker={LocationMarker}
      />
    </Container>
  );
}

export default EventsCreate;
