import React, { useState } from "react";
import { MapContainer, TileLayer, Marker, useMapEvents } from "react-leaflet";
import "leaflet/dist/leaflet.css";
import axios from "axios";

const EventForm = () => {
    const [formData, setFormData] = useState({
        title: "",
        description: "",
        date: "",
        location: { lat: -6.2088, lon: 106.8456 },
    });

    const [address, setAddress] = useState("");

    const handleInputChange = (e) => {
        const { name, value } = e.target;
        setFormData({ ...formData, [name]: value });
    };

    const handleLocationChange = (lat, lon) => {
        setFormData({ ...formData, location: { lat, lon } });
        fetchAddress(lat, lon);
    };

    const fetchAddress = async (lat, lon) => {
        try {
            const response = await axios.get(
                `https://api.geoapify.com/v1/geocode/reverse?lat=${lat}&lon=${lon}&apiKey=1f8c66d7a4794ea294aa88794af83a32`
            );
            setAddress(response.data.features[0]?.properties.formatted || "Unknown");
        } catch (error) {
            console.error("Error fetching address:", error);
        }
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        console.log("Event Data Submitted:", formData);
    };

    const LocationMarker = () => {
        useMapEvents({
            click(e) {
                handleLocationChange(e.latlng.lat, e.latlng.lng);
            },
        });

        return (
            <Marker position={[formData.location.lat, formData.location.lon]} />
        );
    };

    return (
        <div>
            <h1>Tambah Event</h1>
            <form onSubmit={handleSubmit}>
                <div>
                    <label>Judul Event:</label>
                    <input
                        type="text"
                        name="title"
                        value={formData.title}
                        onChange={handleInputChange}
                        required
                    />
                </div>
                <div>
                    <label>Deskripsi:</label>
                    <textarea
                        name="description"
                        value={formData.description}
                        onChange={handleInputChange}
                        required
                    />
                </div>
                <div>
                    <label>Tanggal:</label>
                    <input
                        type="date"
                        name="date"
                        value={formData.date}
                        onChange={handleInputChange}
                        required
                    />
                </div>
                <div>
                    <label>Alamat Lokasi:</label>
                    <p>{address || "Klik di peta untuk memilih lokasi"}</p>
                </div>
                <button type="submit">Simpan Event</button>
            </form>
            <MapContainer
                center={[formData.location.lat, formData.location.lon]}
                zoom={13}
                style={{ height: "400px", width: "100%", marginTop: "20px" }}
            >
                <TileLayer
                    url={`https://maps.geoapify.com/v1/tile/osm-carto/{z}/{x}/{y}.png?apiKey=1f8c66d7a4794ea294aa88794af83a32`}
                />
                <LocationMarker />
            </MapContainer>
        </div>
    );
};

export default EventForm;
