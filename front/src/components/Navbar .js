import React, {useState} from 'react'
import { Link } from 'react-router-dom'
import "components/navbar.css"
const Navbar = () => {
  const [show, setShow] = useState(false);
  function showSwitch(){
    return setShow(!show)
  }
  return (<>
    <div className='navbar'>
      <div className='logo'>
        Page Tittle
      </div>
      <div className={show ? "links active" : "links"  }>
        <Link onClick={()=>showSwitch()} to="/">Home</Link>
        <Link onClick={()=>showSwitch()} to="/about">About</Link>
        <Link onClick={()=>showSwitch()} to="/Categories">Categories</Link>
        <Link onClick={()=>showSwitch()} to="/contact">Contact</Link>
      </div>
      <div onClick={()=>showSwitch()} className={show ? 'bars-button active' : 'bars-button'}>
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    </>
  )
}

export default Navbar;

// Los span son para el responsive, que se vean 3 rayitas 
// blancas para desplegar el menu de navegación

// onclick ShowSwitch para el responsive también.