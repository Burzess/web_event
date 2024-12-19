import React from "react";
import { GoogleLogin } from "react-google-login";
import axios from "axios";
import { useNavigate } from "react-router-dom";

const GoogleLoginButton = () => {
    const navigate = useNavigate();
    const handleSuccess = async (response) => {
        try {
            const { data } = await axios.post(
                "localhost:8000/api/auth/google/callback",
                { token: response.tokenId }
            );

            clg

            localStorage.setItem("authToken", data.token);
            alert("Login sukses!");
            // navigate('/dashboard')
        } catch (error) {
            console.error("Error during login:", error);
        }
    };

    const handleFailure = (error) => {
        console.error("Login gagal:", error);
    };

    return (
        <GoogleLogin
            clientId="781232196159-k5pa6vtu6l4bk2amc1imi11mkgk5s5s5.apps.googleusercontent.com"
            buttonText="Login dengan Google"
            onSuccess={handleSuccess}
            onFailure={handleFailure}
            cookiePolicy="single_host_origin"
        />
    );
};

export default GoogleLoginButton;
