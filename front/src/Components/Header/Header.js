import React from 'react'
import { Link, Outlet } from "react-router-dom";
import "./Header.css";


const Header = () => {
    return (
      <header>
        <nav className='nav'>
          <Link to="/form">Form</Link>
          <Link to="/user">User</Link>
          <Link to="/logs">Logs</Link>
          <Link to="/queue">Queue</Link>
        </nav>
      </header>
  )
}

export default Header