import React from 'react';
import ReactDOM from 'react-dom/client';
import { BrowserRouter, Routes, Route } from "react-router-dom";
import "./index.css";
import App from './App';
import Form from './Components/Form/Form';
import Subscription from './Components/Subscription/Subscription';
import User from './Components/User/User'
import Logs from './Components/Logs/Logs';
import Queue from './Components/Queue/Queue';


export default function Application() {
  return (
   <BrowserRouter>
      <Routes>
      <Route path="/" element={<App />}>
          <Route path="form" index element={<Form />} />
          <Route path="subscription" element={<Subscription />} />
          <Route path="user" element={<User />} />
          <Route path="logs" element={<Logs />} />
          <Route path="queue" element={<Queue />} />
        </Route>
      </Routes>
    </BrowserRouter>
  )
}
const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(<Application />);

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
// reportWebVitals();
