import { useEffect, useState } from "react";
import styles from "./Dashboard.module.css";
import { useNavigate } from "react-router";
export function Dashboard() {
  const [user, setUser] = useState();
const navigate = useNavigate();
// Fetch para obtener información del usuario actual y comprobarlo con el TOKEN.
  useEffect(() => {
    fetch("http://localhost:8080/api/usuario/get", {
      headers: {
        Authorization: "Bearer " + localStorage.getItem("token"),
      },
    })
      .then((res) => res.json())
      .then((data) => {
          setUser(data.result);
        }
      );
  }, []);

  //console.log(user.publicaciones);
  return (
    // Condicional, si hay usuario pintamos y si no, no.
    <>
      {user ? ( <div className={styles.all}>
          <h1 className={styles.welcome}>Bienvenido {user.nombre} a tu panel de control</h1>
        <section className={styles.box}>
        <div className={styles.box}>
          <div className={styles.user}  key={user.id}>
              <div className={styles.imgas}><img  src={user.perfil} /></div>
              <button className={styles.boton} onClick={()=>{
                navigate(`/edituser/${user.id}`, { replace: true })
              }} > Modifica tus datos</button></div>
            <button className={styles.boton1} onClick={()=>{
                navigate("/userguitars", { replace: true })
              }} > Mis instrumentos</button>
        </div>
        </section>
        </div>
      ) : (
        <div>
          loading
        </div>
      )}
    </>
  );
}
