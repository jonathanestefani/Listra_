import Rest from "../Base/Rest";

/**
 * @typedef {CarService}
 */
export default class CarService extends Rest {
  /**
   * @type {String}
   */
  static resource = "/cars";
}
