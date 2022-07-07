import classes from "./Team.module.css";
function Team() {
  return (
    <div class={classes.equipo}>
      <div class={classes.eslogan}>
        <h4>Our Team</h4>
        <div>
          <h2>
            Our Best{" "}
            <span>
              <span>Team</span>
            </span>
          </h2>
        </div>
      </div>
<div className={classes.cards}>
<div className={classes.persona}>
        <div className={classes.personal}>
          <img src={"./images/Danny.jpg"}></img>
        </div>
        <div className={classes.cargos}>
          <h3 className={classes.nombre}>Danny Doe</h3>
          <h4 className={classes.puesto}>Manager</h4>
        </div>
      </div>
      <div className={classes.persona}>
        <div className={classes.personal}>
          <img src={"./images/Erika.jpg"}></img></div>
          <div className={classes.cargos}>
          <h3 className={classes.nombre}>Erika West</h3>
          <h4 className={classes.puesto}>Employee</h4>
        </div>
      </div>
       
      <div className={classes.persona}>
        <div className={classes.personal}>
          <img src={"./images/Juan.jpg"}></img>
        </div>
        <div className={classes.cargos}>
          <h3 className={classes.nombre}>Juan Magan</h3>
          <h4 className={classes.puesto}>Marketing</h4>
        </div>
      </div>

</div>
      
    </div>
  );
}

export default Team;
