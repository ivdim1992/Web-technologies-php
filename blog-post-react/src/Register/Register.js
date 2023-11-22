import React, { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import "./Register.css";

function Register() {
  const [username, setUsername] = useState("");
  const [password, setPassword] = useState("");
  const [emailAddress, setEmail] = useState("");

  const navigate = useNavigate();

  const handleSubmit = async (event) => {
    event.preventDefault();

    const response = await fetch("http://localhost:8000/api/register", {
      method: "POST",
      body: JSON.stringify({
        name: username,
        email: emailAddress,
        password: password,
      }),
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
      },
    });
    const user = await response.json();

    const { name, email, id } = user;

    sessionStorage.setItem("user", JSON.stringify({ name, email, id }));

    navigate("/posts");
  };

  return (
    <div className="Auth-form-container">
      <form className="Auth-form" onSubmit={handleSubmit}>
        <div className="Auth-form-content">
          <h3 className="Auth-form-title">Register</h3>
          <div className="form-group mt-3">
            <label>Username</label>
            <input
              type="text"
              className="form-control mt-1"
              required
              value={username}
              onChange={(e) => {
                setUsername(e.target.value);
              }}
              placeholder="Enter name"
            />
          </div>
          <div className="form-group mt-3">
            <label>Email Address</label>
            <input
              type="email"
              required
              value={emailAddress}
              onChange={(e) => {
                setEmail(e.target.value);
              }}
              className="form-control mt-1"
              placeholder="Enter email"
            />
          </div>
          <div className="form-group mt-3">
            <label>Password</label>
            <input
              type="password"
              required
              value={password}
              onChange={(e) => {
                setPassword(e.target.value);
              }}
              className="form-control mt-1"
              placeholder="Enter password"
            />
          </div>
          <div className="d-grid gap-2 mt-3">
            <button type="submit" className="btn btn-primary">
              Submit
            </button>
          </div>
          <p className="forgot-password text-right mt-2">
            Already have an account <Link to="/">login?</Link>
          </p>
        </div>
      </form>
    </div>
  );
}

export default Register;
