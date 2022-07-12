// import { useContext, useState } from "react";
// import { useNavigate, Navigate } from "react-router-dom";
// import { AuthContext } from "../../components/AuthContext";
// import styles from "./Register.module.css";
// import swal from "sweetalert";
// //Register function, gets token and formValues and check it
// //after, then you will be redirected to Home if all ok.
// const Register = () => {
//   const { setToken } = useContext(AuthContext);
//   const navigate = useNavigate();
//   const [formValues, setFormValues] = useState({ username: "", password: "", nombre:"",perfil:"" });
//   const handleInputChange = (e) => {
//     setFormValues((prev) => ({ ...prev, [e.target.name]: e.target.value }));
//   };
//   //Petition to server.
//   const handleSubmit = (e) => {
//     e.preventDefault();
//     fetch("http://localhost:8080/api/usuario/new", {
//       method: "POST",
//       body: JSON.stringify(formValues),
//       headers: {
//         "Content-Type": "application/json",
//       },
//     })
//       .then((res) => res.json())
//       .then((data) => {
//         navigate("/login", { replace: true });
//         swal("You can sig in now!");
//       });
//   };
//   //When you click Register, it doesn't do anything but
//   // If you go to DB you will se there's the new user,
//   // didnt have time for more, sorry.
//   return (
//     <>
//       <h1>Regístrese aquí</h1>
//       <div className={styles.reg}>
//         <form className={styles.contactform} onSubmit={handleSubmit}>
//           <label className={styles.labels} htmlFor="nombre">
//             Nombre
//           </label>
//           <input
//             className={styles.user}
//             placeholder="Escriba aquí su nombre de usuario"
//             required={true}
//             id="nombre"
//             name="nombre"
//             type="text"
//             onChange={handleInputChange}
//             value={formValues.nombre}
//           />
//            <label className={styles.labels} htmlFor="username">
//             Email
//           </label>
//           <input
//             className={styles.user}
//             placeholder="Escriba aquí su email"
//             required={true}
//             id="username"
//             name="username"
//             type="email"
//             onChange={handleInputChange}
//             value={formValues.username}
//           />
//           <label className={styles.labels} htmlFor="password">
//             Contraseña
//           </label>
//           <input
//             className={styles.password}
//             placeholder="Escriba aquí su contraseña"
//             required={true}
//             id="password"
//             name="password"
//             type="password"
//             onChange={handleInputChange}
//             values={formValues.password}
//           />
//                 <label className={styles.labels} htmlFor="perfil">
//             Nombre
//           </label>
//           <input
//             className={styles.user}
//             required={true}
//             id="perfil"
//             name="perfil"
//             type="file"
//             accept="image/*"
//             onChange={handleInputChange}
//             value={formValues.perfil}
//           />
//           <button className={styles.boton} type="submit">
//             {" "}
//             Crear cuenta
//           </button>
//         </form>
//       </div>
//     </>
//   );
// };
// export default Register;

import { useState } from "react";
import { useNavigate } from "react-router-dom";
import styles from "./Register.module.css";
import { Link } from "react-router-dom";
import swal from "sweetalert";
//Register function, gets token and formValues and check it
//after, then you will be redirected to Home if all ok.
const Register = () => {
  const navigate = useNavigate();
  const [formValues, setFormValues] = useState({
    username: "",
    password: "",
    nombre: "",
    perfil: "",
  });
  const handleInputChange = (e) => {
    setFormValues((prev) => ({ ...prev, [e.target.name]: e.target.value }));
  };
  //Petition to server.
  const handleSubmit = (e) => {
    e.preventDefault();

    let formData = new FormData();
    formData.append("nombre", formValues.nombre);
    formData.append("password", formValues.password);
    formData.append("username", formValues.username);
    formData.append("perfil", e.target.perfil.files[0]);


    fetch("http://localhost:8080/api/usuario/new", {
      method: "POST",
      body: formData,
      headers: {
        enctype: "multipart/form-data",
      },
    })
      .then((res) => res.json())
      .then((data) => {
        navigate("/login", { replace: true });
        swal("You can sig in now!");
      });

  };
  return (
    <>
      <h1>Sign up here</h1>
      <div className={styles.reg}>
        <form className={styles.contactform} onSubmit={handleSubmit}>
          <label className={styles.labels} htmlFor="username">
            Email
          </label>
          <input
            className={styles.user}
            placeholder="Enter your email"
            required={true}
            id="username"
            name="username"
            type="email"
            onChange={handleInputChange}
            value={formValues.username}
          />
          <label className={styles.labels} htmlFor="nombre">
            First name
          </label>
          <input
            className={styles.password}
            placeholder="Enter your name"
            required={true}
            id="nombre"
            name="nombre"
            type="text"
            onChange={handleInputChange}
            values={formValues.nombre}
          />
          <label className={styles.labels} htmlFor="password">
            Password
          </label>
          <input
            className={styles.password}
            placeholder="Enter your password"
            required={true}
            id="password"
            name="password"
            type="password"
            onChange={handleInputChange}
            values={formValues.password}
          />
          <label className={styles.labels} htmlFor="perfil">
            Profile photo
          </label>
          <input
            className={styles.imagen}
            id="perfil"
            name="perfil"
            type="file"
            accept="image/*"
            onChange={handleInputChange}
          />
          <button className={styles.boton} type="submit">
            {" "}
           Create account
          </button>
          <div className={styles.links}>
            <Link to="/login"> Sig in</Link>
          </div>
        </form>
      </div>
    </>
  );
};
export default Register;

