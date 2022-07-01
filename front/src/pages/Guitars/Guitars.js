import { useEffect, useState } from "react";
import "../Guitars/Guitars.css";
function Guitars() {
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
      <h2>Todas las guitarras</h2>
      <section>
        {Guitarras.map((guitarra) => (
          <div className="guitarras" key={guitarra.id}>
            <div>{guitarra.nombre}</div>
            <div>{guitarra.caracteristicas}</div>
            <div className="images">
              <img src={`./images/${guitarra.imagen}`} />
            </div>
          </div>
        ))}
      </section>
    </div>
  );
}
export default Guitars;
