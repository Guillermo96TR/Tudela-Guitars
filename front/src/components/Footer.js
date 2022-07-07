import classes from "./Footer.module.css";
// import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import {
  faCcPaypal,
  faCcAmazonPay,
  faCcJcb,
  faCcMastercard,
  faCcVisa,
} from "@fortawesome/free-brands-svg-icons";

function Footer() {
  return (
    <footer className={`${classes.footer} ${classes.flexBetween}`}>
      <div>Made with love by Guillermo Tudela @ Copyright 2022 </div>
      <div className={classes.flexBetween}>
        Supported Payment: 
        <span className={classes.flexBetween}>
          <FontAwesomeIcon icon={faCcAmazonPay} />
          <FontAwesomeIcon icon={faCcPaypal} />
          <FontAwesomeIcon icon={faCcJcb} />
          <FontAwesomeIcon icon={faCcMastercard} />
          <FontAwesomeIcon icon={faCcVisa} />
        </span>
      </div>
    </footer>
  );
}
export default Footer;
