import { useEffect, useState } from "react";
import guitars from "./bassguitars.module.css";
import { Link } from "react-router-dom";
export default function BassGuitars() {
  const [Bajos, setBajos] = useState([]);
  useEffect(() => {
    fetch("http://127.0.0.1:8080/bass/guitar", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    })
      .then((data) => data.json())
      .then((data) => setBajos(data.result));
  }, []);

  return (
    <div>
      <h2 className={guitars.tituloprincipal}>Todos los bajos</h2>
      <section className={guitars.sectionGuitar}>
        {Bajos.map((guitarra) => (
          <div className={guitars.guitarras} key={guitarra.id}>
            <div className={guitars.nombre}>{guitarra.nombre}</div>
            <div className={guitars.images}>
            <Link to={`/bassguitars/${guitarra.id}`}>
                  <img src={`./images/${guitarra.imagen}`} />
                </Link>
            </div>
          </div>
        ))}
      </section>
    </div>
  );
}
