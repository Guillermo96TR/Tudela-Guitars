import { BrowserRouter } from "react-router-dom";
import Navbar from "./components/Navbar ";
import Main from "./components/Main";
import Footer from "./components/Footer";

function App() {
  return (
    <BrowserRouter>
      <Navbar />
      <Main/>
      <Footer/>
    </BrowserRouter>
  );
}
export default App;
