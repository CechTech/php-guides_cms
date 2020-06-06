import { Controller } from "stimulus";

export default class extends Controller {
  static targets = ["global", "single"];

  connect() {
    console.log("connected");
  }

  toggle() {
    if(this.globalTarget.checked === true) {
      this.singleTarget.checked = true;
    } else {
      this.singleTarget.checked = false;
    }
    console.log("erfsfe");
  }
}
