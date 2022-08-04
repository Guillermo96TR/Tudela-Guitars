import React, { useState } from "react";
import { Link } from "react-router-dom";
import { AuthContext } from "./AuthContext";
import { useContext } from "react";
import "./navbar.css";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faGuitar } from "@fortawesome/free-solid-svg-icons";

const Navbar = () => {
  const [show, setShow] = useState(false);
  const { token } = useContext(AuthContext);
  function showSwitch() {
    return setShow(!show);
  }
  function logout() {
    localStorage.clear();
    window.location.href = "/";
  }
  return (
    <>
      {!token ? (
        <div className="navbar">
          <div className="logo">
            <em>
              <FontAwesomeIcon icon={faGuitar} className="fa-2xl logoIcon" />{" "}
              Tudela Guitars
            </em>
          </div>
          <div className={show ? "links active" : "links"}>
            <Link onClick={() => showSwitch()} to="/">
              Inicio
            </Link>
            <Link onClick={() => showSwitch()} to="/about">
              Nosotros
            </Link>
            <Link onClick={() => showSwitch()} to="/guitars">
              Guitarras
            </Link>
            <Link onClick={() => showSwitch()} to="/bassguitars">
              Bajos
            </Link>
            <Link onClick={() => showSwitch()} to="/contacto">
              Contacto
            </Link>
            <Link onClick={() => showSwitch()} to="/login">
              Logueo/Registro
            </Link>
          </div>
          <div
            onClick={() => showSwitch()}
            className={show ? "bars-button active" : "bars-button"}
          >
            <span></span>
            <span></span>
            <span></span>
          </div>
        </div>
      ) : (
        <div className="navbar">
          <div className="logo">
            <em>
              {" "}
              <FontAwesomeIcon
                icon={faGuitar}
                className="fa-2xl logoIcon"
              />{" "}
              Tudela Guitars
            </em>
          </div>
          <div className={show ? "links active" : "links"}>
            <Link onClick={() => showSwitch()} to="/">
              Inicio
            </Link>
            <Link onClick={() => showSwitch()} to="/about">
              Nosotros
            </Link>
            <Link onClick={() => showSwitch()} to="/guitars">
              Guitarras
            </Link>
            <Link onClick={() => showSwitch()} to="/bassguitars">
              Bajos
            </Link>
            <Link onClick={() => showSwitch()} to="/contacto">
              Contacto
            </Link>
            <Link onClick={() => showSwitch()} to="/dashboard">
              Perfil
            </Link>
            <Link onClick={() => logout()} to="/">
              Logout
            </Link>
          </div>
          <div
            onClick={() => showSwitch()}
            className={show ? "bars-button active" : "bars-button"}
          >
            <span></span>
            <span></span>
            <span></span>
          </div>
        </div>
      )}
    </>
  );
};

export default Navbar;

// Los span son para el responsive, que se vean 3 rayitas
// blancas para desplegar el menu de navegación

// onclick ShowSwitch para el responsive también.
