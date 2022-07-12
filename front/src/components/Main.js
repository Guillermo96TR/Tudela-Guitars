import { Route, Routes } from "react-router-dom";
import classes from "./Main.module.css";
import { Navigate } from "react-router-dom";
import { NotFound } from "../pages/Notfound/Notfound";
import Home from "../pages/Home/Home";
import About from "../pages/About/About";
import Guitars from "../pages/Guitars/Guitars";
import Contact from "../pages/Contacto/Contact";
import Guitar from "../pages/Guitars/Guitar";
import Enviado from "../pages/Enviado/Enviado";
import BassGuitars from "../pages/bassguitars/bassguitars";
import Login from "../pages/Login/Login";
import Register from "../pages/Register/Register";
import { UserGuitars } from "../pages/Guitars/UserGuitars";
import { NewBassGuitar } from "../pages/Guitars/NewBassGuitar";
import { NewGuitar } from "../pages/Guitars/NewGuitars";
import { Dashboard } from "../pages/Dashboard/Dashboard";
import EditGuitars from "../pages/Guitars/EditGuitars";
import BassGuitar from "../pages/bassguitars/bassguitar";
import EditBassGuitars from "../pages/Guitars/EditBassGuitars";
import EditUser from "../pages/Dashboard/EditUser";
function Main() {
  return (
    <main className={classes.main}>
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/about" element={<About />} />
        <Route path="/guitars">
          <Route index element={<Guitars />} />
          <Route path=":id" element={<Guitar />} />
        </Route>
        <Route path="/bassguitars">
          <Route path="/bassguitars" element={<BassGuitars />} />
          <Route path=":id" element={<BassGuitar />} />
        </Route>
        <Route path="/contacto" element={<Contact />} />
        <Route path="/newbassguitar" element={<NewBassGuitar />} />
        <Route path="/newguitar" element={<NewGuitar />} />
        <Route path="/userguitars" element={<UserGuitars />} />
        <Route path="/edituserguitars/:id" element={<EditGuitars />} />
        <Route path="/edituser/:id" element={<EditUser />} />
        <Route path="/edituserbassguitars/:id" element={<EditBassGuitars />} />
        <Route path="/enviado" element={<Enviado />} />
        <Route path="/register" element={<Register />} />
        <Route path="/contacto" element={<Contact />} />
        <Route path="/login" element={<Login />} />
        <Route path="/dashboard" element={<Dashboard />} />
        <Route path="/404" element={<NotFound />} />
        <Route path="*" element={<Navigate to="404" replace />} />
      </Routes>
    </main>
  );
}
export default Main;
