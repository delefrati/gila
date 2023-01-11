import React from 'react'
import { BrowserRouter, Link } from "react-router-dom"
import Form from Form

function Header() {
  return (
    <BrowserRouter>
        <nav>
            <Link to={`/Form`} activeClassName="active">Subscribe</Link>
            <Link to={`/users/`} activeClassName="active">Users</Link>
            <Link to={`/logs/`} activeClassName="active">Logs</Link>
            <Link to={`/queue/`} activeClassName="active">Queue</Link>
        </nav>
    </BrowserRouter>
  )
}

export default Header