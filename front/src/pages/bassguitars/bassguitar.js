import { useEffect, useState } from "react";
import bassguitars from "./bassguitars.module.css";
import { Link } from "react-router-dom";
import { useParams } from "react-router-dom";
export default function BassGuitar() {
  const { id } = useParams();
  const [Bajo, setBajo] = useState([]);
  useEffect(() => {
    fetch(`http://127.0.0.1:8080/bassguitars/${id}`, {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    })
      .then((data) => data.json())
      .then((data) => setBajo(data.result));
  }, []);

  return (
    <div>
      <Link className={bassguitars.link} to={"/bassguitars"}>
        Go back to list
      </Link>
      <div>
        {Bajo ? (
          <section className={bassguitars.section1Guitar}>
            <div className={bassguitars.box}>
              <div className={bassguitars.nombre}>{Bajo.nombre}</div>
              <br></br>
              <div className={bassguitars.images}>
              <img src={`../images/${Bajo.imagen}`} />
              </div>
              <div className={bassguitars.caracteristicas}>
                {Bajo.caracteristicas}
              </div>
              <br></br>
              <div className={bassguitars.precio}> Precio: {Bajo.precio}$</div>
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
