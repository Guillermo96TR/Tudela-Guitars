import { useEffect, useState } from "react";
import "../bassguitars/bassguitars.css";
function BassGuitars() {
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
      <section>
        {Bajos.map((bajo) => (
          <div className="bajos" key={bajo.id}>
            <div>{bajo.nombre}</div>
            <div>{bajo.caracteristicas}</div>
            <div className="images">
              <img src={`./images/${bajo.imagen}`} />
            </div>
          </div>
        ))}
      </section>
    </div>
  );
}
export default BassGuitars;
