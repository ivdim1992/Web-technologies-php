import React, { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import "./Login.css";

function Login() {
  const [username, setUsername] = useState("");
  const [password, setPassword] = useState("");

  const navigate = useNavigate();

  const handleSubmit = async (event) => {
    event.preventDefault();

    const response = await fetch("http://localhost:8000/api/login", {
      method: "POST",
      body: JSON.stringify({ loginname: username, loginpassword: password }),
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
          <h3 className="Auth-form-title">Sign In</h3>
          <div className="form-group mt-3">
            <label>Username</label>
            <input
              type="text"
              required
              className="form-control mt-1"
              placeholder="Enter name"
              value={username}
              onChange={(e) => {
                setUsername(e.target.value);
              }}
            />
          </div>
          <div className="form-group mt-3">
            <label>Password</label>
            <input
              type="password"
              className="form-control mt-1"
              required
              placeholder="Enter password"
              value={password}
              onChange={(e) => {
                setPassword(e.target.value);
              }}
            />
          </div>
          <div className="d-grid gap-2 mt-3">
            <button type="submit" className="btn btn-primary">
              Submit
            </button>
          </div>
          <p className="forgot-password text-right mt-2">
            Don't have an account <Link to="/register">register?</Link>
          </p>
        </div>
      </form>
    </div>
  );
}

export default Login;
