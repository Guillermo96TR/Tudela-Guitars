import { useEffect, useState } from "react";
import bassGuitar from "./bassguitars.module.css"
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
      <h2>Todos los bajos</h2>
      <section className={bassGuitar.sectionBassGuitar}>
        {Bajos.map((bajo) => (
          <div className={bassGuitar.bajos} key={bajo.id}>
            <div>{bajo.nombre}</div>
            <div>{bajo.caracteristicas}</div>
            <div className={bassGuitar.images}>
              <img src={`./images/${bajo.imagen}`} alt="images bass guitar" />
            </div>
          </div>
        ))}
      </section>
    </div>
  );
}
