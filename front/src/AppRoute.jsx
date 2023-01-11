import React from "react";
import { BrowserRouter, Route, Routes} from 'react-router-dom';
import Notifications from "./Components/Notifications/Notifications";
import History from "./Components/History/History";
import Home from "./Components/Home";


const AppRoute = () => {
    return(
        <BrowserRouter>
          <Routes>
              <Route  path="/" element={ <Home />}/>
              <Route  path="/notifications" element={ <Notifications />}/>
              <Route  path="/history" element={ <History />}/>
          </Routes>
      </BrowserRouter>
     )
}

export default AppRoute;