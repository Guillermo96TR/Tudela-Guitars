import { useEffect, useState } from "react";
import guitars from "./Guitars.module.css";
export default function Guitars() {
  const [Guitarras, setGuitarras] = useState([]);
  useEffect(() => {
    fetch("http://127.0.0.1:8080/guitars", {
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
      <h2>Todos nuestros modelos de guitarras</h2>
      <section className={guitars.sectionGuitar}>
        {Guitarras.map((guitarra) => (
          <div className={guitars.guitarras} key={guitarra.id}>
            <div>{guitarra.nombre}</div>
            <div>{guitarra.caracteristicas}</div>
            <div className={guitars.images}>
              <img src={`./images/${guitarra.imagen}`}  alt="images guitar" />
            </div>
          </div>
        ))}
      </section>
    </div>
  );
}
