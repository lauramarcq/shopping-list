import { shallowMount } from "@vue/test-utils";
import SuccessAlert from "./SuccessAlert.vue";

describe("SuccessAlert", () => {
    it("renders the success alert component correctly", () => {
        const wrapper = shallowMount(SuccessAlert);
        expect(wrapper.html()).toMatchSnapshot();
    });

    it('emits the "update:showSuccess" event when the close button is clicked', () => {
        const wrapper = shallowMount(SuccessAlert);
        const closeButton = wrapper.find("svg");
        closeButton.trigger("click");
        expect(wrapper.emitted("update:showSuccess")).toBeTruthy();
    });
});
