import { useEffect, useState } from "react";
import guitars from "./Guitars.module.css";
import {Link} from "react-router-dom";
export default function Guitars() {
  const [Guitarras, setGuitarras] = useState([]);
  useEffect(() => {
    fetch("http://localhost:8080/guitars", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    })
      .then((data) => data.json())
      .then((data) => setGuitarras(data.result));
  }, []);

  return (
    <div>
      <h2 className={guitars.tituloprincipal}>Guitarras disponibles</h2>
      <section className={guitars.sectionGuitar}>
        {Guitarras.map((guitarra) => (
          <div className={guitars.guitarras} key={guitarra.id}>
            <div className={guitars.nombre}>{guitarra.nombre}</div>
            <div className={guitars.images}>
            <Link to={`/guitars/${guitarra.id}`}>
                  <img src={guitarra.imagen} />
                </Link>
            </div>
          </div>
        ))}
      </section>
    </div>
  );
}
