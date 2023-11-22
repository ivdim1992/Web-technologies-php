import "bootstrap/dist/css/bootstrap.min.css";
import "./App.css";

import Login from "./Login/Login";
import Posts from "./Posts/Posts";
import Register from "./Register/Register";

import React from "react";
import {
  Navigate,
  Route,
  BrowserRouter as Router,
  Routes,
} from "react-router-dom";

function App() {
  return (
    <Router>
      <Routes>
        <Route path="/posts" element={<Posts />} />
        <Route path="/register" element={<Register />} />
        <Route path="/login" element={<Login />} />
        <Route path="/" element={<Navigate replace to="/login" />} />
      </Routes>
    </Router>
  );
}

export default App;
