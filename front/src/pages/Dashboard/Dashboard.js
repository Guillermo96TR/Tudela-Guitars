import { Link } from "react-router-dom";
import styleDashboard from "./Dashboard.module.css";
import imageGuitar from "../../assets/images/imagen.jpg";
import imageBassGuitar from "../../assets/images/imagen4.jpg";

export function Dashboard(){

    //fetch(`http://localhost:8080/api/user/`)


    return (
        <section className={styleDashboard.dashboard}>
            <div className={styleDashboard.dashTitulo}><Link to={`/profile`}>Ver perfil</Link></div>
            <div className={styleDashboard.dashSections}>
                <div>
                    <Link to={`/my-guitars`}>
                    <img src={imageGuitar} alt='imagen Guitarra' width="300px" height="300px" />
                    <h2>Mis guitarras</h2>
                    </Link>
                </div>
                <div>
                    <img src={imageBassGuitar} alt='imagen Bajos' width="300px" height="300px" />
                    <h2>Mis bajos</h2>
                </div>
            </div>
        </section>
    );
}