import { useEffect, useState } from "react";
import guitars from "./Guitars.module.css";
import { Link } from "react-router-dom";
import { useParams } from "react-router-dom";
export default function Guitar() {
  const { id } = useParams();
  const [Guitarra, setGuitarra] = useState([]);
  useEffect(() => {
    fetch(`http://localhost:8080/guitars/${id}`, {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    })
      .then((data) => data.json())
      .then((data) => setGuitarra(data.result));
  }, []);

  return (
    <div>
      <Link className={guitars.link} to={"/guitars"}>
        Go back to list
      </Link>
      <div>
        {Guitarra ? (
          <section className={guitars.section1Guitar}>
            <div className={guitars.box}>
              <div className={guitars.nombre}>{Guitarra.nombre}</div>
              <br></br>
              <div className={guitars.images}>
                <img src={Guitarra.imagen} />
              </div>
              <div className={guitars.caracteristicas}>
                {Guitarra.caracteristicas}
              </div>
              <br></br>
              <div className={guitars.precio}> Precio: {Guitarra.precio}$</div>
              <br></br>
            </div>
          </section>
        ) : (
          <div>
            <p>Cargando...</p>
          </div>
        )}
      </div>
    </div>
  );
}
