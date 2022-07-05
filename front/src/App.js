import { Route, Routes } from "react-router-dom";
import { BrowserRouter } from "react-router-dom";
import { Navigate } from "react-router-dom";
import { NotFound } from "./pages/Notfound/Notfound";
import Home from "./pages/Home/Home";
import About from "./pages/About/About";
import Guitars from "./pages/Guitars/Guitars";
import Contact from "./pages/Contacto/Contact";
import Enviado from "./pages/Enviado/Enviado";
import BassGuitars from "./pages/bassguitars/bassguitars";
import Navbar from "./components/Navbar ";
import Login from "./pages/Login/Login";
import Register from "./pages/Register/Register";
function App() {
  return (
    <BrowserRouter>
      <Navbar />
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/about" element={<About />} />
        {/* <Route path="/publicaciones"> */}
        {/* <Route index element={<Publicaciones />} /> */}
        {/* <Route path=":id" element={<Publicacion />} /> */}
        {/* </Route> */}
        <Route path="/guitars" element={<Guitars />} />
        <Route path="/contacto" element={<Contact />} />
        <Route path="/enviado" element={<Enviado />} />
        <Route path="/register" element={<Register />} />
        <Route path="/bassguitars" element={<BassGuitars />} />
        <Route path="/contacto" element={<Contact />} />
        <Route path="/login" element={<Login />} />
        <Route path="/404" element={<NotFound />} />
        <Route path="*" element={<Navigate to="404" replace />} />
      </Routes>
    </BrowserRouter>
  );
}
export default App;
