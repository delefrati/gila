import React, { useEffect, useState } from "react";
import './Logs.css'
import api from '../../services/api'

function Logs() {

  const [logs, setLogs] = useState();

  useEffect(() => {
    api
      .get("/logs")
      .then((response) => {
        setLogs(response.data);
      })
      .catch((err) => {
        console.error("Oops, got an error!" + err);
      });
  }, []);

  const getLogs = () => {
    if (logs === undefined) {
      return '';
    }
    return logs.map((log) => {
      return <tr><td>{log.date}</td><td>{log.log}</td></tr>
    })
  }

  return (
    <div className="container">
      <h1>Logs</h1>
      <table>
        <thead>
          <tr>
            <th>Date</th>
            <th>Log</th>
          </tr>
        </thead>
        <tbody>
          {getLogs()}
        </tbody>
      </table>
    </div>
  )
}

export default Logs