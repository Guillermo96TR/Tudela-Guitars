import classes from "./about.module.css";
function About() {
  return (
    <div class={classes.equipo}>
      <h2>About us</h2>
      <div className={classes.history}>
        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quae
        architecto culpa ex sunt veritatis quo illo, quasi nemo! Nulla quaerat,
        illum sapiente nesciunt maxime ipsum inventore fugiat quisquam cum
        deleniti! Veritatis temporibus facere modi. Saepe molestiae labore
        sapiente reiciendis est odit nesciunt cumque quisquam asperiores,
        quaerat repudiandae nihil corrupti eum, atque modi voluptates placeat
        sunt qui suscipit ab aliquam voluptas. Illum quo natus totam fugit,
        eligendi temporibus, eos nihil praesentium enim voluptatum ratione
        quisquam voluptate delectus exercitationem sed debitis pariatur repellat
        molestias minus tenetur in necessitatibus, obcaecati architecto.
        Commodi, odio! Natus aut exercitationem tenetur labore animi, laudantium
        assumenda accusamus ex, doloribus odio tempora quas commodi architecto
      </div>
      <div class={classes.eslogan}>
        <h2>Nuestro equipo </h2>
      </div>
      <div className={classes.cards}>
        <div className={classes.persona}>
          <div className={classes.personal}>
            <img src={"./images/Danny.jpg"}></img>
          </div>
          <div className={classes.cargos}>
            <h3 className={classes.nombre}>Danny Doe</h3>
            {/* <h4 className={classes.puesto}>Manager</h4> */}
          </div>
        </div>
        <div className={classes.persona}>
          <div className={classes.personal}>
            <img src={"./images/Erika.jpg"}></img>
          </div>
          <div className={classes.cargos}>
            <h3 className={classes.nombre}>Erika West</h3>
            {/* <h4 className={classes.puesto}>Employee</h4> */}
          </div>
        </div>

        <div className={classes.persona}>
          <div className={classes.personal}>
            <img src={"./images/Juan.jpg"}></img>
          </div>
          <div className={classes.cargos}>
            <h3 className={classes.nombre}>Juan Magan</h3>
            {/* <h4 className={classes.puesto}>Marketing</h4> */}
          </div>
        </div>
      </div>
    </div>
  );
}

export default About;
