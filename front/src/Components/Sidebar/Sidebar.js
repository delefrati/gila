
import React, { useContext } from 'react'
import Notifications from '../Notifications/Notifications';
import History from '../History/History';
import Home from '../Home';
import { BrowserRouter, Link, Route, Routes} from 'react-router-dom';

const Sidebar = () => {

  return (
    <BrowserRouter>
        <Routes>
            <Route  path="/" element={ <Home />}/>
            <Route  path="/notifications" element={ <Notifications />}/>
            <Route  path="/history" element={ <History />}/>
        </Routes>

    <ul className="nav nav-pills flex-column mb-auto">
      <li className="nav-item">
        <a href="/" className="nav-link active" aria-current="page">
          <i></i>
          Home
        </a>
      </li>
      <li>
        <a href="/notifications" className="nav-link link-dark">
        <i></i>
          Notifications
        </a>
      </li>
      <li>
        <a href="/history" className="nav-link link-dark">
        <i></i>
          History
        </a>
      </li>
    </ul>
</BrowserRouter>
  )
}



export default Sidebar;